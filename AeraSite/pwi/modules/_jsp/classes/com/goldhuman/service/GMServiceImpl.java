/*      */ package com.goldhuman.service;
/*      */ 
/*      */ import com.goldhuman.Common.Conf;
/*      */ import com.goldhuman.Common.Octets;
/*      */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*      */ import com.goldhuman.service.interfaces.BackupRoleBean;
/*      */ import com.goldhuman.service.interfaces.CashInfoBean;
/*      */ import com.goldhuman.service.interfaces.ComplainRe;
/*      */ import com.goldhuman.service.interfaces.LogInfo;
/*      */ import com.goldhuman.service.interfaces.ModifyDateBean;
/*      */ import com.goldhuman.service.interfaces.MoveRoleResult;
/*      */ import com.goldhuman.service.interfaces.QueryUseridBean;
/*      */ import com.goldhuman.service.interfaces.RoleForbidBean;
/*      */ import com.goldhuman.service.interfaces.SimpleRoleBean;
/*      */ import com.goldhuman.service.interfaces.StoreHousePWDRoleBean;
/*      */ import com.goldhuman.util.LocaleUtil;
/*      */ import com.goldhuman.util.MyProcess2;
/*      */ import com.goldhuman.util.MyProcessReader;
/*      */ import com.goldhuman.util.PresentGoodsId;
/*      */ import java.io.FileOutputStream;
/*      */ import java.io.InputStream;
/*      */ import java.text.SimpleDateFormat;
/*      */ import java.util.Date;
/*      */ import java.util.HashSet;
/*      */ import java.util.Iterator;
/*      */ import java.util.Set;
/*      */ import java.util.Vector;
/*      */ import org.apache.commons.logging.Log;
/*      */ import org.apache.commons.logging.LogFactory;
/*      */ import protocol.DeliveryDB;
/*      */ import protocol.GRoleBase;
/*      */ import protocol.GRoleForbid;
/*      */ import protocol.GRoleInventory;
/*      */ import protocol.GRoleStatus;
/*      */ import protocol.GameDB;
/*      */ import protocol.IntOctets;
/*      */ import protocol.QueryUseridRes;
/*      */ import protocol.SysRecoveredObjMail_Re;
/*      */ import protocol.UniquenameDB;
/*      */ import protocol.User;
/*      */ import protocol.XmlRole;
/*      */ import protocol.XmlRole.Role;
/*      */ 
/*      */ public class GMServiceImpl extends AllInterface
/*      */ {
/*   27 */   private static final Log log = LogFactory.getLog(GMServiceImpl.class);
/*      */ 
/*      */   private void info(String info, LogInfo loginfo) {
/*   30 */     log.info(info + " gm: " + loginfo.userName + "(" + loginfo.userId + "),reason: " + loginfo.reason);
/*      */   }
/*      */ 
/*      */   public boolean GMPrivilegeChange(int userid, LogInfo loginfo) {
/*      */     try {
/*   35 */       boolean ret = DeliveryDB.GMPrivilegeChange(userid);
/*   36 */       info(" GMPrivilegeChange(" + userid + "),ret=" + ret, loginfo);
/*   37 */       return ret; } catch (Exception ex) {
/*   38 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean replyComplain(ComplainRe reply, LogInfo loginfo)
/*      */   {
/*      */     try {
/*   44 */       boolean ret = DeliveryDB.replyComplain(reply.roleid, reply.gmroleid, reply.gmrolename, reply.content);
/*   45 */       info(" replyComplain(" + reply.roleid + "),ret=" + ret, loginfo);
/*   46 */       return ret;
/*      */     } catch (Exception ex) {
/*   48 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public RoleForbidBean ForbidUserInfo(int userid, LogInfo loginfo)
/*      */   {
/*   54 */     GRoleForbid ret = _ForbidUser(0, userid, 0, "", loginfo.userId);
/*   55 */     if (null == ret) {
/*   56 */       info(" ForbidUserInfo userid=" + userid + ",ret null", loginfo);
/*   57 */       return null;
/*      */     }
/*   59 */     info(" ForbidUserInfo userid=" + userid + ",ret ok", loginfo);
/*   60 */     return convertForbidBean(ret);
/*      */   }
/*      */ 
/*      */   public RoleForbidBean ForbidUser(int userid, int time, String reason, LogInfo loginfo) {
/*   64 */     GRoleForbid ret = _ForbidUser(1, userid, time, reason, loginfo.userId);
/*   65 */     if (null == ret) {
/*   66 */       info("ForbidUser userid=" + userid + ", time=" + time + ", reason=" + reason + ", ret null", loginfo);
/*   67 */       return null;
/*      */     }
/*   69 */     info("ForbidUser userid=" + userid + ", time=" + time + ", reason=" + reason + ", ret ok", loginfo);
/*   70 */     return convertForbidBean(ret);
/*      */   }
/*      */ 
/*      */   public boolean UnforbidUser(int userid, LogInfo loginfo) {
/*   74 */     GRoleForbid ret = _ForbidUser(2, userid, 0, "", loginfo.userId);
/*   75 */     if (null == ret) {
/*   76 */       info("UnforbidUser userid=" + userid + ", ret null", loginfo);
/*   77 */       return false;
/*      */     }
/*   79 */     info("UnforbidUser userid=" + userid + ", ret ok", loginfo);
/*   80 */     return true;
/*      */   }
/*      */ 
/*      */   private RoleForbidBean convertForbidBean(GRoleForbid forbid) {
/*   84 */     if (forbid == null) return null;
/*   85 */     RoleForbidBean forbidBean = new RoleForbidBean();
/*   86 */     forbidBean.type = forbid.type;
/*   87 */     forbidBean.time = forbid.time;
/*   88 */     forbidBean.createtime = forbid.createtime;
/*      */     try { forbidBean.reason = forbid.reason.getString(); } catch (Exception e) {
/*   90 */       e.printStackTrace();
/*   91 */     }return forbidBean;
/*      */   }
/*      */ 
/*      */   private GRoleForbid _ForbidUser(int operation, int userid, int time, String reason, int opId)
/*      */   {
/*      */     try
/*      */     {
/*   98 */       return DeliveryDB.DlyForbidUser(operation, userid, time, reason, opId); } catch (Exception ex) {
/*   99 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public MoveRoleResult moveRoleGetXML(Vector roles, LogInfo loginfo)
/*      */   {
/*  324 */     info(" moveRoleGetXML return null", loginfo);
/*  325 */     return null;
/*      */   }
/*      */ 
/*      */   public MoveRoleResult moveRolePutXML(Vector roles, LogInfo loginfo) {
/*  329 */     info("moveRolePutXML return null", loginfo);
/*  330 */     return null;
/*      */   }
/*      */ 
/*      */   public MoveRoleResult moveRoleForbid(Vector roles, LogInfo loginfo) {
/*  334 */     info("MoveRoleResult return null", loginfo);
/*  335 */     return null;
/*      */   }
/*      */ 
/*      */   public byte[] getRoleInfoXML(int roleid, LogInfo loginfo) {
/*      */     try {
/*  340 */       XmlRole.Role role = XmlRole.getRoleFromDB(roleid);
/*  341 */       if (null == role)
/*      */       {
/*  343 */         info(" getRoleInfoXML(" + roleid + "),XmlRole.getRoleFromDB return null", loginfo);
/*  344 */         return null;
/*      */       }
/*  346 */       byte[] ret = XmlRole.toXMLByteArray(role);
/*  347 */       if (null == ret) {
/*  348 */         info(" getRoleInfoXML(" + roleid + "),XmlRole.toXMLByteArray return null", loginfo);
/*      */       }
/*      */       else {
/*  351 */         info(" getRoleInfoXML(" + roleid + "),success", loginfo);
/*      */ 
/*  353 */         Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/outcoming");
/*  354 */         new FileOutputStream("/var/spool/rolexml/outcoming/" + roleid + "_" + System.currentTimeMillis() / 1000L + ".xml").write(new String(XmlRole.toXMLByteArray(role), "UTF-8").getBytes("GBK"));
/*      */       }
/*      */ 
/*  360 */       return ret; } catch (Exception ex) {
/*  361 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public boolean putRoleInfoXML(int roleid, byte[] xmlbytes, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  367 */       info(" putRoleInfoXML(" + roleid + ")", loginfo);
/*  368 */       if (roleid < 32)
/*      */       {
/*  370 */         info("putRoleInfoXML(" + roleid + "),roleid less than 32", loginfo);
/*  371 */         return false;
/*      */       }
/*  373 */       XmlRole.Role role = XmlRole.fromXML(xmlbytes);
/*  374 */       if (null != role)
/*      */       {
/*  376 */         int userid = GameDB.Roleid2Uid(roleid);
/*  377 */         role.base.userid = userid;
/*  378 */         boolean ret = XmlRole.putRoleToDB(roleid, role);
/*  379 */         if (!ret) {
/*  380 */           info("putRoleInfoXML(" + roleid + "),XmlRole.putRoleToDB ret false", loginfo);
/*      */         }
/*  382 */         Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/incoming");
/*  383 */         new FileOutputStream("/var/spool/rolexml/incoming/" + roleid + "_" + (ret ? "ok" : "fail") + "_" + System.currentTimeMillis() / 1000L + ".xml").write(new String(XmlRole.toXMLByteArray(role), "UTF-8").getBytes("GBK"));
/*      */ 
/*  386 */         return ret;
/*      */       }
/*      */ 
/*  390 */       info("parse xml role error. roleid=" + roleid, loginfo);
/*  391 */       return false;
/*      */     } catch (Exception ex) {
/*  393 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean isForbid(Rpc.Data.DataVector forbid)
/*      */   {
/*  398 */     for (int i = 0; i < forbid.size(); i++)
/*      */     {
/*  400 */       GRoleForbid f = (GRoleForbid)forbid.get(i);
/*  401 */       if (f.type == 100)
/*      */       {
/*  403 */         if (f.createtime + f.time > (int)(System.currentTimeMillis() / 1000L))
/*  404 */           return true;
/*      */       }
/*      */     }
/*  407 */     return false;
/*      */   }
/*      */ 
/*      */   public int roleid2Uid(Integer roleid, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  414 */       int ret = GameDB.Roleid2Uid(roleid.intValue());
/*  415 */       info(" roleid2Uid(" + roleid + "),ret=" + ret, loginfo);
/*  416 */       return ret;
/*      */     } catch (Exception ex) {
/*  418 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int uid2Logicuid(Integer userid, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  424 */       int ret = GameDB.Uid2Logicuid(userid.intValue());
/*  425 */       info(" uid2Logicuid(" + userid + "),ret=" + ret, loginfo);
/*  426 */       return ret;
/*      */     } catch (Exception ex) {
/*  428 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int getRoleIdByName(String rolename, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  435 */       int ret = GameDB.getRoleIdByName(rolename);
/*  436 */       info(" getRoleIdByName(" + rolename + "),ret=" + ret, loginfo);
/*  437 */       return ret;
/*      */     } catch (Exception ex) {
/*  439 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int canChangeRolename(String rolename, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  446 */       int ret = GameDB.canChangeRolename(rolename, 0);
/*  447 */       if (60 == ret) ret = 2;
/*  448 */       info(" canChangeRolename(" + rolename + "),ret=" + ret, loginfo);
/*  449 */       return ret; } catch (Exception ex) {
/*  450 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int forbidRole(byte fbd_type, int gmroleid, int localsid, int dstroleid, int forbid_time, String reason, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  463 */       int ret = DeliveryDB.GMForbidRole(fbd_type, gmroleid, localsid, dstroleid, forbid_time, reason);
/*  464 */       info(" forbidRole(" + fbd_type + "," + gmroleid + "," + localsid + "," + dstroleid + "," + forbid_time + "," + reason + "),ret=" + ret, loginfo);
/*      */ 
/*  466 */       return ret; } catch (Exception ex) {
/*  467 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int getRoleLogStatus(int roleid, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  473 */       int ret = DeliveryDB.getRoleLogStatus(roleid);
/*  474 */       info(" getRoleLogStatus(" + roleid + "),ret=" + ret, loginfo);
/*  475 */       return ret;
/*      */     } catch (Exception ex) {
/*  477 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public boolean SetMaxOnlineNum(int maxonlinenum, int fakemaxonlinenum, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  483 */       boolean ret = DeliveryDB.SetMaxOnlineNum(maxonlinenum, fakemaxonlinenum);
/*  484 */       info(" SetMaxOnlineNum(" + maxonlinenum + "," + fakemaxonlinenum + "),ret=" + ret, loginfo);
/*  485 */       return ret; } catch (Exception ex) {
/*  486 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public int GetOnlineNum(LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  493 */       int ret = -1;
/*  494 */       Integer[] curmax = new Integer[3];
/*  495 */       if (!DeliveryDB.GetMaxOnlineNum(curmax))
/*  496 */         ret = -1;
/*      */       else
/*  498 */         ret = null == curmax[2] ? -1 : curmax[2].intValue();
/*  499 */       info(" GetOnlineNum(),ret=" + ret, loginfo);
/*  500 */       return ret; } catch (Exception ex) {
/*  501 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int rolenameExists(String rolename, LogInfo loginfo) {
/*      */     try {
/*  506 */       int ret = UniquenameDB.RolenameExists(rolename);
/*  507 */       info(" rolenameExists(" + rolename + "),ret=" + ret, loginfo);
/*  508 */       return ret; } catch (Exception ex) {
/*  509 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int userRoleCount(Integer userid, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  515 */       int ret = UniquenameDB.UserRoleCount(userid.intValue());
/*  516 */       info(" userRoleCount(" + userid + "),ret=" + ret, loginfo);
/*  517 */       return ret; } catch (Exception ex) {
/*  518 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public Vector getRolelist(int userid, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  524 */       info(" getRolelist(" + userid + ")", loginfo);
/*  525 */       Rpc.Data.DataVector dv = GameDB.getRolelist(userid);
/*  526 */       if (null == dv)
/*  527 */         return null;
/*  528 */       Iterator iter = dv.iterator();
/*  529 */       Vector v = new Vector();
/*  530 */       while (iter.hasNext())
/*      */       {
/*  532 */         IntOctets ios = (IntOctets)iter.next();
/*  533 */         SimpleRoleBean bean = new SimpleRoleBean();
/*  534 */         bean.roleid = ios.m_int;
/*  535 */         bean.rolename = ios.m_octets.getString();
/*  536 */         GRoleStatus status = GameDB.getRoleStatus(bean.roleid);
/*  537 */         if (null != status)
/*  538 */           bean.level = status.level;
/*      */         else
/*  540 */           bean.level = -1;
/*  541 */         v.add(bean);
/*      */       }
/*  543 */       return v;
/*      */     } catch (Exception ex) {
/*  545 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   private static String toHexString(byte[] x) {
/*  549 */     StringBuffer sb = new StringBuffer(x.length * 2);
/*  550 */     for (int i = 0; i < x.length; i++)
/*      */     {
/*  552 */       byte n = x[i];
/*  553 */       int nibble = n >> 4 & 0xF;
/*  554 */       sb.append((char)(nibble >= 10 ? 97 + nibble - 10 : 48 + nibble));
/*  555 */       nibble = n & 0xF;
/*  556 */       sb.append((char)(nibble >= 10 ? 97 + nibble - 10 : 48 + nibble));
/*      */     }
/*  558 */     return sb.toString();
/*      */   }
/*      */ 
/*      */   public Vector getRole_StorehousePWDlist(int userid, LogInfo loginfo) {
/*      */     try {
/*  563 */       info(" getRole_StorehousePWDlist(" + userid + ")", loginfo);
/*  564 */       Rpc.Data.DataVector dv = GameDB.getRolelist(userid);
/*  565 */       if (null == dv)
/*  566 */         return null;
/*  567 */       Iterator iter = dv.iterator();
/*  568 */       Vector v = new Vector();
/*  569 */       while (iter.hasNext())
/*      */       {
/*  571 */         IntOctets ios = (IntOctets)iter.next();
/*  572 */         StoreHousePWDRoleBean bean = new StoreHousePWDRoleBean();
/*  573 */         bean.rolename = ios.m_octets.getString();
/*  574 */         GRoleStatus status = GameDB.getRoleStatus(ios.m_int);
/*  575 */         if (null != status) {
/*  576 */           bean.storehousepwd = toHexString(status.storehousepasswd.getBytes());
/*      */         }
/*      */         else
/*  579 */           bean.storehousepwd = null;
/*  580 */         v.add(bean);
/*      */       }
/*  582 */       info(" getRole_StorehousePWDlist(" + userid + ") size=" + v.size(), loginfo);
/*  583 */       return v;
/*      */     } catch (Exception ex) {
/*  585 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public CashInfoBean getCashInfo(int userid, LogInfo loginfo) {
/*      */     try {
/*  590 */       User user = GameDB.getUser(userid);
/*  591 */       if (null == user)
/*      */       {
/*  593 */         info(" getCashInfo(" + userid + "),ret=null", loginfo);
/*  594 */         return null;
/*      */       }
/*  596 */       CashInfoBean bean = new CashInfoBean();
/*  597 */       bean.userid = userid;
/*  598 */       bean.cash = user.cash;
/*  599 */       bean.money = user.money;
/*  600 */       bean.cash_add = user.cash_add;
/*  601 */       bean.cash_buy = user.cash_buy;
/*  602 */       bean.cash_sell = user.cash_sell;
/*  603 */       bean.cash_used = user.cash_used;
/*  604 */       return bean;
/*      */     } catch (Exception ex) {
/*  606 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public int getRoleLevelByName(String rolename, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  613 */       int roleid = GameDB.getRoleIdByName(rolename);
/*  614 */       if (roleid > 0)
/*      */       {
/*  616 */         GRoleStatus status = GameDB.getRoleStatus(roleid);
/*  617 */         info(" getRoleLevelByName(" + rolename + "),ret=" + status.level, loginfo);
/*  618 */         return status.level;
/*      */       }
/*  620 */       info(" getRoleLevelByName(" + rolename + "),ret=-1", loginfo);
/*  621 */       return -1;
/*      */     } catch (Exception ex) {
/*  623 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int verifyFactionMaster(int userid, String rolename, String factionname, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  630 */       int roleid = GameDB.getRoleIdByName(rolename);
/*  631 */       if (roleid <= 0)
/*      */       {
/*  633 */         info(" verifyFactionMaster(" + userid + "," + rolename + "," + factionname + "),ret=-4", loginfo);
/*  634 */         return -4;
/*      */       }
/*  636 */       if (GameDB.Roleid2Uid(roleid) != userid)
/*      */       {
/*  638 */         info(" verifyFactionMaster(" + userid + "," + rolename + "," + factionname + "),ret=-4,roleid=" + roleid, loginfo);
/*      */ 
/*  640 */         return -4;
/*      */       }
/*  642 */       if ((null != factionname) && (factionname.length() > 0))
/*      */       {
/*  644 */         int ret = GameDB.DBVerifyMaster(rolename, factionname);
/*  645 */         info(" verifyFactionMaster(" + rolename + "," + factionname + "),ret=" + ret, loginfo);
/*  646 */         return ret;
/*      */       }
/*      */ 
/*  650 */       GRoleStatus status = GameDB.getRoleStatus(roleid);
/*      */ 
/*  653 */       return -6;
/*      */     }
/*      */     catch (Exception ex) {
/*  656 */       ex.printStackTrace(); } return -8;
/*      */   }
/*      */ 
/*      */   public int clearStorehousePasswd(int roleid, String rolename, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  662 */       int ret = GameDB.clearStorehousePasswd(roleid, rolename);
/*  663 */       info(" clearStorehousePasswd(" + roleid + "," + rolename + "),ret=" + ret, loginfo);
/*  664 */       return ret;
/*      */     } catch (Exception ex) {
/*  666 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int renameRole(int userid, int zoneid, String oldname, String newname, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  672 */       int roleid = GameDB.getRoleIdByName(oldname);
/*  673 */       if (roleid <= 0)
/*      */       {
/*  675 */         info(" renameRole(" + userid + "," + oldname + "," + newname + "),ret=4", loginfo);
/*  676 */         return 4;
/*      */       }
/*  678 */       if (GameDB.Roleid2Uid(roleid) != userid)
/*      */       {
/*  680 */         info(" renameRole(" + userid + "," + oldname + "," + newname + "),ret=5", loginfo);
/*  681 */         return 5;
/*      */       }
/*  683 */       int ret = GameDB.renameRole(roleid, oldname, newname);
/*  684 */       info(" renameRole(" + userid + "," + oldname + "," + newname + "),ret=" + ret, loginfo);
/*  685 */       if (0 == ret)
/*  686 */         UniquenameDB.PostCreateRole((byte)1, userid, zoneid, roleid, newname);
/*  687 */       return ret;
/*      */     } catch (Exception ex) {
/*  689 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int deleteRole(int userid, String rolename, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  695 */       int roleid = GameDB.getRoleIdByName(rolename);
/*  696 */       if (roleid <= 0)
/*      */       {
/*  698 */         info(" deleteRole(" + userid + "," + rolename + "),ret=3", loginfo);
/*  699 */         return 3;
/*      */       }
/*  701 */       if (GameDB.Roleid2Uid(roleid) != userid)
/*      */       {
/*  703 */         info(" deleteRole(" + userid + "," + rolename + "),ret=4", loginfo);
/*  704 */         return 4;
/*      */       }
/*  706 */       boolean b = GameDB.deleteRolePermanent(roleid);
/*  707 */       int ret = b ? 0 : -1;
/*  708 */       info(" deleteRole(" + userid + "," + rolename + "),ret=" + ret, loginfo);
/*  709 */       if (b)
/*  710 */         UniquenameDB.PostDeleteRole(userid, 0, roleid, rolename);
/*  711 */       return ret;
/*      */     } catch (Exception ex) {
/*  713 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public Vector getRoleForbid(int roleid, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  719 */       info("getRoleForbid(),roleid=" + roleid, loginfo);
/*  720 */       GRoleBase base = GameDB.getRoleBase(roleid);
/*  721 */       Vector v = new Vector();
/*  722 */       for (int i = 0; i < base.forbid.size(); i++)
/*      */       {
/*  724 */         GRoleForbid f = (GRoleForbid)base.forbid.get(i);
/*  725 */         RoleForbidBean bean = new RoleForbidBean();
/*  726 */         bean.type = f.type;
/*  727 */         bean.time = f.time;
/*  728 */         bean.createtime = f.createtime;
/*  729 */         bean.reason = f.reason.getString();
/*  730 */         v.add(bean);
/*      */       }
/*  732 */       return v;
/*      */     } catch (Exception ex) {
/*  734 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public String getServiceStatus(LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  741 */       info(" getServiceStatus()", loginfo);
/*      */ 
/*  743 */       String result = new String();
/*  744 */       String[] name = new String[9];
/*  745 */       String[] exes = new String[9];
/*      */ 
/*  747 */       name[0] = "uniquename:";
/*  748 */       name[1] = "database:  ";
/*  749 */       name[2] = "gacd:      ";
/*  750 */       name[3] = "delivery:  ";
/*  751 */       name[4] = "link1:     ";
/*  752 */       name[5] = "link2:     ";
/*  753 */       name[6] = "game1:     ";
/*  754 */       name[7] = "game2:     ";
/*  755 */       name[8] = "game3:     ";
/*      */ 
/*  757 */       exes[0] = "/usr/bin/snmpwalk -Oqv backup 1.3.6.1.4.1.2021.2.1.5.8";
/*  758 */       exes[1] = "/usr/bin/snmpwalk -Oqv database 1.3.6.1.4.1.2021.2.1.5.2";
/*  759 */       exes[2] = "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.7";
/*      */ 
/*  761 */       exes[3] = "/usr/bin/snmpwalk -Oqv delivery 1.3.6.1.4.1.2021.2.1.5.4";
/*  762 */       exes[4] = "/usr/bin/snmpwalk -Oqv link1 1.3.6.1.4.1.2021.2.1.5.5";
/*  763 */       exes[5] = "/usr/bin/snmpwalk -Oqv link2 1.3.6.1.4.1.2021.2.1.5.5";
/*  764 */       exes[6] = "/usr/bin/snmpwalk -Oqv game1 1.3.6.1.4.1.2021.2.1.5.6";
/*  765 */       exes[7] = "/usr/bin/snmpwalk -Oqv game2 1.3.6.1.4.1.2021.2.1.5.6";
/*  766 */       exes[8] = "/usr/bin/snmpwalk -Oqv game3 1.3.6.1.4.1.2021.2.1.5.6";
/*      */ 
/*  768 */       for (int i = 0; (i < name.length) && (i < exes.length); i++)
/*      */       {
/*  770 */         result = result + name[i];
/*  771 */         byte[] b = new byte[''];
/*  772 */         Runtime.getRuntime().exec(exes[i]).getInputStream().read(b);
/*  773 */         result = result + new String(b);
/*      */       }
/*  775 */       return result; } catch (Exception ex) {
/*  776 */       ex.printStackTrace(); } return "";
/*      */   }
/*      */ 
/*      */   public boolean broadCast(String msg, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  783 */       boolean ret = DeliveryDB.broadcast(Byte.parseByte("9"), loginfo.userId, msg);
/*  784 */       info(" broadCast(" + msg + "),ret=" + ret, loginfo);
/*  785 */       return ret; } catch (Exception ex) {
/*  786 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean linelimit(String limits, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  811 */       info("linelimit() no used. limits=" + limits, loginfo);
/*  812 */       return false; } catch (Exception e) {
/*  813 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public int modifyRoleLevel(int roleid, int level, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  819 */       int ret = GameDB.modifyRoleLevel(roleid, level);
/*  820 */       info(" modifyRoleLevel(" + roleid + "," + level + "),ret=" + ret, loginfo);
/*  821 */       return ret;
/*      */     } catch (Exception ex) {
/*  823 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRoleExp(int roleid, long exp, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  830 */       int ret = GameDB.modifyRoleExp(roleid, exp);
/*  831 */       info(" modifyRoleExp(" + roleid + "," + exp + "),ret=" + ret, loginfo);
/*  832 */       return ret;
/*      */     } catch (Exception ex) {
/*  834 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRolePocketMoney(int roleid, int pocket_money, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  842 */       int ret = GameDB.modifyRolePocketMoney(roleid, pocket_money);
/*  843 */       info(" modifyRolePocketMoney(" + roleid + "," + pocket_money + "),ret=" + ret, loginfo);
/*  844 */       return ret;
/*      */     } catch (Exception ex) {
/*  846 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRoleStoreMoney(int roleid, int store_money, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  854 */       int ret = GameDB.modifyRoleStoreMoney(roleid, store_money);
/*  855 */       info(" modifyRoleStoreMoney(" + roleid + "," + store_money + "),ret=" + ret, loginfo);
/*  856 */       return ret;
/*      */     } catch (Exception ex) {
/*  858 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRolePkvalue(int roleid, int pkvalue, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  866 */       int ret = GameDB.modifyRolePkvalue(roleid, pkvalue);
/*  867 */       info(" modifyRolePkvalue(" + roleid + "," + pkvalue + "),ret=" + ret, loginfo);
/*  868 */       return ret;
/*      */     } catch (Exception ex) {
/*  870 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRoleReputation(int roleid, int reputation, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  878 */       int ret = GameDB.modifyRoleReputation(roleid, reputation);
/*  879 */       info(" modifyRoleReputation(" + roleid + "," + reputation + "),ret=" + ret, loginfo);
/*  880 */       return ret;
/*      */     } catch (Exception ex) {
/*  882 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRolePotential(int roleid, int potential, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  890 */       int ret = GameDB.modifyRolePotential(roleid, potential);
/*  891 */       info(" modifyRolePotential(" + roleid + "," + potential + "),ret=" + ret, loginfo);
/*  892 */       return ret;
/*      */     } catch (Exception ex) {
/*  894 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRoleOccupation(int roleid, int occupation, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  902 */       int ret = GameDB.modifyRoleOccupation(roleid, occupation);
/*  903 */       info(" modifyRoleOccupation(" + roleid + "," + occupation + "),ret=" + ret, loginfo);
/*  904 */       return ret;
/*      */     } catch (Exception ex) {
/*  906 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public int modifyRoleAllMoney(int roleid, int pocket_money, int store_money, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  914 */       int ret = GameDB.modifyRoleAllMoney(roleid, pocket_money, store_money);
/*  915 */       info(" modifyRoleAllMoney(" + roleid + "," + pocket_money + "," + store_money + "),ret=" + ret, loginfo);
/*  916 */       return ret;
/*      */     } catch (Exception ex) {
/*  918 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public long modifyRoleClearAllMoney(int roleid, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  925 */       long ret = GameDB.modifyRoleClearAllMoney(roleid);
/*  926 */       info(" modifyRoleClearAllMoney(" + roleid + "),ret=" + ret, loginfo);
/*  927 */       return ret;
/*      */     } catch (Exception ex) {
/*  929 */       ex.printStackTrace(); } return -1L;
/*      */   }
/*      */ 
/*      */   public QueryUseridBean queryUserByName(String rolename, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  935 */       QueryUseridRes res = GameDB.getUseridByName(rolename);
/*  936 */       info("queryUseridByName(" + rolename + ") ret=" + res, loginfo);
/*  937 */       if (null != res) {
/*  938 */         QueryUseridBean bean = new QueryUseridBean();
/*  939 */         bean.result = res.result;
/*  940 */         bean.userid = res.userid;
/*  941 */         bean.roleid = res.roleid;
/*  942 */         bean.level = res.level;
/*  943 */         return bean;
/*      */       }
/*  945 */       return null;
/*      */     } catch (Exception ex) {
/*  947 */       ex.printStackTrace(); } return null;
/*      */   }
/*      */ 
/*      */   public boolean shutdownGameFriendly(int waitsecs, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  954 */       info(" shutdownGameFriendly():waitsecs=" + waitsecs, loginfo);
/*  955 */       byte[] b = new byte[4096];
/*  956 */       Runtime.getRuntime().exec("/usr/sbin/rshrun --loadgroup=game /usr/bin/killall -w -9 loader").getInputStream().read(b);
/*  957 */       return DeliveryDB.GMRestartServer(loginfo.userId, waitsecs); } catch (Exception ex) {
/*  958 */       ex.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean restartgamefriendly(int waitsecs, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  965 */       boolean ret = DeliveryDB.GMRestartServer(-1, waitsecs);
/*  966 */       info(" restartgamefriendly(),waitsecs=" + waitsecs + ",ret=" + ret, loginfo);
/*  967 */       return ret; } catch (Exception e) {
/*  968 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setdoubleexp(int status, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/*  976 */       boolean ret = DeliveryDB.GMSetDoubleExp(status);
/*  977 */       info(" setdoubleexp(),status=" + status + ",ret=" + ret, loginfo);
/*  978 */       return ret; } catch (Exception e) {
/*  979 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setdoublemoney(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  985 */       boolean ret = DeliveryDB.GMSetDoubleMoney(status);
/*  986 */       info(" setdoublemoney(),status=" + status + ",ret=" + ret, loginfo);
/*  987 */       return ret; } catch (Exception e) {
/*  988 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setdoubleobject(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/*  994 */       boolean ret = DeliveryDB.GMSetDoubleObject(status);
/*  995 */       info(" setdoubleobject(),status=" + status + ",ret=" + ret, loginfo);
/*  996 */       return ret; } catch (Exception e) {
/*  997 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setdoublesp(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1003 */       boolean ret = DeliveryDB.GMSetDoubleSP(status);
/* 1004 */       info(" setdoublesp(), status=" + status + ",ret=" + ret, loginfo);
/* 1005 */       return ret; } catch (Exception e) {
/* 1006 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setlambda(int lambda, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1012 */       boolean ret = DeliveryDB.GMSetLambda(lambda);
/* 1013 */       info(" setlambda(), lambda=" + lambda + ",ret=" + ret, loginfo);
/* 1014 */       return ret; } catch (Exception e) {
/* 1015 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setnoauction(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try
/*      */     {
/* 1022 */       boolean ret = DeliveryDB.GMSetNoAuction(status);
/* 1023 */       info(" setnoauction(), status=" + status + ",ret=" + ret, loginfo);
/* 1024 */       return ret; } catch (Exception e) {
/* 1025 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setnofaction(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1031 */       boolean ret = DeliveryDB.GMSetNoFaction(status);
/* 1032 */       info(" setnofaction(), status=" + status + ",ret=" + ret, loginfo);
/* 1033 */       return ret; } catch (Exception e) {
/* 1034 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setnomail(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1040 */       boolean ret = DeliveryDB.GMSetNoMail(status);
/* 1041 */       info(" setnomail(), status=" + status + ",ret=" + ret, loginfo);
/* 1042 */       return ret; } catch (Exception e) {
/* 1043 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setnosellpoint(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1049 */       boolean ret = DeliveryDB.GMSetNoSellPoint(status);
/* 1050 */       info(" setnosellpoint(), status=" + status + ",ret=" + ret, loginfo);
/* 1051 */       return ret; } catch (Exception e) {
/* 1052 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean setnotrade(boolean status, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1058 */       boolean ret = DeliveryDB.GMSetNoTrade(status);
/* 1059 */       info(" setnotrade(), status=" + status + ",ret=" + ret, loginfo);
/* 1060 */       return ret; } catch (Exception e) {
/* 1061 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public boolean disableAutolock(int userid, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1067 */       boolean ret = DeliveryDB.DisableAutolock(userid);
/* 1068 */       info(" disableAutolock(), userid=" + userid + ",ret=" + ret, loginfo);
/* 1069 */       return ret; } catch (Exception e) {
/* 1070 */       e.printStackTrace(); } return false;
/*      */   }
/*      */ 
/*      */   public BackupRoleBean getBackupRole(String backup, int roleid, LogInfo loginfo) {
/* 1074 */     BackupRoleBean brb = new BackupRoleBean();
/* 1075 */     MyProcessReader process = new MyProcessReader("/root/bin/getrolexml.sh " + backup + " " + roleid);
/*      */     try {
/* 1077 */       info("getBackupRole backupdir=" + backup + ",roleid=" + roleid, loginfo);
/* 1078 */       process.run();
/* 1079 */       if (process.isOk()) {
/* 1080 */         String rolexml = process.getRolexml();
/* 1081 */         if ((rolexml == null) && (rolexml.length() < 0)) {
/* 1082 */           throw new Exception("rolexml length is null");
/*      */         }
/* 1084 */         XmlRole.Role role = XmlRole.fromXML(rolexml.getBytes("UTF-8"));
/* 1085 */         byte[] xmlbytes = XmlRole.toXMLByteArray(role);
/* 1086 */         brb.rolexml = new String(xmlbytes, "UTF-8");
/* 1087 */         brb.errmessage = process.getErr();
/* 1088 */         brb.retcode = 0;
/* 1089 */         return brb;
/*      */       }
/*      */     } catch (Exception e) { e.printStackTrace(); }
/* 1092 */     info("error getBackupRole bakupdir=" + backup + ",roleid=" + roleid + "," + process.toString(), loginfo);
/* 1093 */     brb.retcode = -1;
/* 1094 */     brb.errmessage = process.getErr();
/* 1095 */     brb.rolexml = "";
/* 1096 */     return brb;
/*      */   }
/*      */ 
/*      */   public Double getw2iexperience(LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1102 */       info("getw2iexperience()", loginfo);
/* 1103 */       byte status = DeliveryDB.GMGetDoubleExp();
/* 1104 */       return new Double(new Double(Byte.toString(status)).doubleValue() / 10.0D);
/*      */     } catch (Exception e) {
/* 1106 */       e.printStackTrace();
/* 1107 */       info("getw2iexperience() error", loginfo);
/* 1108 */     }return null;
/*      */   }
/*      */ 
/*      */   public boolean setw2iexperience(Double experience, LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1114 */       int exp = new Double(experience.doubleValue() * 10.0D).intValue();
/* 1115 */       boolean success = DeliveryDB.GMSetDoubleExp(exp);
/* 1116 */       info("setw2iexperience() experience = " + experience + ",success=" + success, loginfo);
/* 1117 */       return success; } catch (Exception e) {
/* 1118 */       e.printStackTrace();
/* 1119 */       info("setw2iexperience() experience = " + experience + ",error", loginfo);
/* 1120 */     }return false;
/*      */   }
/*      */ 
/*      */   public String getSystemTime(LogInfo loginfo)
/*      */   {
/*      */     try {
/* 1126 */       SimpleDateFormat sdf = new SimpleDateFormat("yyyyMMdd HH:mm:ss");
/* 1127 */       Date date = new Date(System.currentTimeMillis());
/* 1128 */       info("getSystime date=" + date.toString(), loginfo);
/* 1129 */       return sdf.format(date);
/*      */     } catch (Exception e) {
/* 1131 */       e.printStackTrace();
/*      */ 
/* 1133 */       info("getSystime err", loginfo);
/* 1134 */     }return "";
/*      */   }
/*      */ 
/*      */   public ModifyDateBean ModifyDate(String releaser, String date, LogInfo loginfo)
/*      */   {
/* 1139 */     ModifyDateBean ret = new ModifyDateBean();
/* 1140 */     ret.result = false;
/*      */ 
/* 1150 */     String systime = getSystemTime(loginfo);
/*      */ 
/* 1152 */     String msg = "ModifyDate ,date=" + date;
/* 1153 */     String cmd = "/root/bin/modifydate.sh \"" + date + "\"";
/*      */     try {
/* 1155 */       MyProcess2 process = new MyProcess2(cmd);
/* 1156 */       process.run();
/* 1157 */       if (process.isOk()) {
/* 1158 */         ret.result = true;
/* 1159 */         ret.date = systime;
/* 1160 */         info(msg + ",before time=" + systime + ", after time= " + date + " ok", loginfo);
/* 1161 */         return ret;
/*      */       }
/*      */     } catch (Exception e) {
/* 1164 */       e.printStackTrace();
/*      */     }
/* 1166 */     info(msg + ",error", loginfo);
/* 1167 */     return ret;
/*      */   }
/*      */ 
/*      */   public boolean toplist(LogInfo loginfo) {
/* 1171 */     String cmd = "/root/bin/toplist.sh";
/* 1172 */     MyProcess process = new MyProcess(cmd);
/* 1173 */     boolean ret = false;
/*      */     try {
/* 1175 */       process.run();
/* 1176 */       ret = process.isOk();
/*      */     } catch (Exception e) {
/* 1178 */       e.printStackTrace();
/*      */     }
/* 1180 */     info("toplist() return " + ret, loginfo);
/* 1181 */     return ret;
/*      */   }
/*      */ 
/*      */   public boolean weekToplist(LogInfo loginfo)
/*      */   {
/* 1186 */     String cmd = "/root/bin/weektoplist.sh";
/* 1187 */     MyProcess process = new MyProcess(cmd);
/* 1188 */     boolean ret = false;
/*      */     try {
/* 1190 */       process.run();
/* 1191 */       ret = process.isOk();
/*      */     } catch (Exception e) {
/* 1193 */       e.printStackTrace();
/*      */     }
/* 1195 */     info("weektoplist() return " + ret, loginfo);
/* 1196 */     return ret;
/*      */   }
/*      */ 
/*      */   private boolean presentgoodsCheck(Vector goods, Set<Integer> idset)
/*      */   {
/*      */     try
/*      */     {
/* 1270 */       boolean pidon = Conf.GetInstance().find("iweb", "pidon").equals("true");
/* 1271 */       if (pidon) {
/* 1272 */         PresentGoodsId pgi = PresentGoodsId.getInstance();
/* 1273 */         for (int i = 0; i < goods.size(); i++) {
/* 1274 */           GRoleInventory inv = (GRoleInventory)goods.get(i);
/* 1275 */           if (!pgi.contains(Integer.valueOf(inv.id))) idset.add(Integer.valueOf(inv.id));
/*      */         }
/* 1277 */         if (idset.size() > 0) return false;
/* 1278 */         return true;
/* 1279 */       }return true;
/*      */     } catch (Exception e) {
/* 1281 */       e.printStackTrace();
/*      */     }
/* 1283 */     return false;
/*      */   }
/*      */ 
/*      */   public int presentGoods(int userid, String rolename, Vector goods, LogInfo loginfo) {
/* 1287 */     if ((getLanguage() == null) || (getLanguage().length() <= 0))
/*      */     {
/* 1289 */       info("presentGoods not allow", loginfo);
/* 1290 */       return -1;
/*      */     }
/*      */     try {
/* 1293 */       Set idset = new HashSet();
/* 1294 */       if (!presentgoodsCheck(goods, idset)) {
/* 1295 */         info(" presentGoods(" + userid + "," + rolename + ")" + idset + "),ret=9", loginfo);
/* 1296 */         return 9;
/*      */       }
/* 1298 */       int roleid = GameDB.getRoleIdByName(rolename);
/* 1299 */       if (roleid <= 0)
/*      */       {
/* 1301 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=6", loginfo);
/* 1302 */         return 6;
/*      */       }
/* 1304 */       if (userid != GameDB.Roleid2Uid(roleid))
/*      */       {
/* 1306 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=7,roleid=" + roleid, loginfo);
/* 1307 */         return 7;
/*      */       }
/* 1309 */       if (goods.size() > 1)
/*      */       {
/* 1311 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=8", loginfo);
/* 1312 */         return 8;
/*      */       }
/* 1314 */       String title = LocaleUtil.getAppMessage(getLanguage(), "GMServiceImpl_presentGoods_title");
/* 1315 */       String content = LocaleUtil.getAppMessage(getLanguage(), "GMServiceImpl_presentGoods_content");
/* 1316 */       for (int i = 0; i < goods.size(); i++)
/*      */       {
/* 1318 */         GRoleInventory inv = (GRoleInventory)goods.get(i);
/*      */         boolean ret;
/*      */         boolean ret;
/* 1320 */         if ((title.length() > 0) || (content.length() > 0))
/* 1321 */           ret = DeliveryDB.SysSendMail(roleid, title, content, inv, 0);
/*      */         else
/* 1323 */           ret = DeliveryDB.SysSendMail(roleid, "奖品", "恭喜您获得奖品，请收取附件。", inv, 0);
/* 1324 */         if (!ret)
/*      */         {
/* 1326 */           info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=8,id=" + inv.id, loginfo);
/* 1327 */           return 8;
/*      */         }
/*      */       }
/* 1330 */       info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=0", loginfo);
/* 1331 */       return 0;
/*      */     } catch (Exception ex) {
/* 1333 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ 
/*      */   public Integer SysRecoveredObjMail(int roleid, String title, String context, String obj, String checksum, LogInfo loginfo) {
/*      */     try {
/* 1338 */       SysRecoveredObjMail_Re ret = DeliveryDB.SysRecoveredObjMail(roleid, title, context, obj, checksum);
/* 1339 */       info(" SysRecoveredObjMail(),roleid=" + roleid + ",title=" + title + ",context=" + context + ",obj=" + obj + ",checksum=" + checksum + ",ret=" + ret.retcode, loginfo);
/* 1340 */       if (ret == null) return Integer.valueOf(-1);
/* 1341 */       return new Integer(ret.retcode);
/*      */     } catch (Exception e) {
/* 1343 */       e.printStackTrace();
/*      */     }
/* 1345 */     return Integer.valueOf(-1);
/*      */   }
/*      */ 
/*      */   public int presentGoods(int userid, String rolename, String title, String context, Vector goods, LogInfo loginfo) {
/*      */     try {
/* 1350 */       Set idset = new HashSet();
/* 1351 */       if (!presentgoodsCheck(goods, idset)) {
/* 1352 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + ",error idset=" + idset + "),ret=9", loginfo);
/* 1353 */         return 9;
/*      */       }
/* 1355 */       int roleid = GameDB.getRoleIdByName(rolename);
/* 1356 */       if (roleid <= 0)
/*      */       {
/* 1358 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=6", loginfo);
/* 1359 */         return 6;
/*      */       }
/* 1361 */       if (GameDB.Roleid2Uid(roleid) != userid)
/*      */       {
/* 1363 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=7,roleid=" + roleid, loginfo);
/* 1364 */         return 7;
/*      */       }
/* 1366 */       if (goods.size() > 1)
/*      */       {
/* 1368 */         info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=8", loginfo);
/* 1369 */         return 8;
/*      */       }
/*      */ 
/* 1372 */       for (int i = 0; i < goods.size(); i++)
/*      */       {
/* 1374 */         GRoleInventory inv = (GRoleInventory)goods.get(i);
/* 1375 */         if (!DeliveryDB.SysSendMail(roleid, title, context, inv, 0))
/*      */         {
/* 1377 */           info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=8,id=" + inv.id, loginfo);
/* 1378 */           return 8;
/*      */         }
/*      */       }
/* 1381 */       info(" presentGoods(" + userid + "," + rolename + "," + goods.size() + "),ret=0", loginfo);
/* 1382 */       return 0;
/*      */     } catch (Exception ex) {
/* 1384 */       ex.printStackTrace(); } return -1;
/*      */   }
/*      */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     com.goldhuman.service.GMServiceImpl
 * JD-Core Version:    0.6.2
 */