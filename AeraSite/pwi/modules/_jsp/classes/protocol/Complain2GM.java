/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Conf;
/*     */ import com.goldhuman.Common.Marshal.MarshalException;
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Manager;
/*     */ import com.goldhuman.IO.Protocol.Protocol;
/*     */ import com.goldhuman.IO.Protocol.ProtocolException;
/*     */ import com.goldhuman.IO.Protocol.Session;
/*     */ import com.goldhuman.service.GMServiceImpl;
/*     */ import com.goldhuman.service.interfaces.Complain;
/*     */ import com.goldhuman.service.interfaces.GMService;
/*     */ import com.goldhuman.service.interfaces.LogInfo;
/*     */ import com.goldhuman.util.LocalDB;
/*     */ import com.goldhuman.util.MySqlCon;
/*     */ import java.io.PrintStream;
/*     */ 
/*     */ public final class Complain2GM extends Protocol
/*     */ {
/*     */   public int roleid;
/*     */   public int localsid;
/*     */   public Octets rolename;
/*     */   public Octets comp_rolename;
/*     */   public int zoneid;
/*     */   public Octets mapzone;
/*     */   public float posx;
/*     */   public float posy;
/*     */   public float posz;
/*     */   public Octets content;
/*     */ 
/*     */   public Complain2GM()
/*     */   {
/*  37 */     this.rolename = new Octets();
/*  38 */     this.comp_rolename = new Octets();
/*  39 */     this.mapzone = new Octets();
/*  40 */     this.content = new Octets();
/*     */   }
/*     */ 
/*     */   public OctetsStream marshal(OctetsStream os) {
/*  44 */     os.marshal(this.roleid);
/*  45 */     os.marshal(this.localsid);
/*  46 */     os.marshal(this.rolename);
/*  47 */     os.marshal(this.comp_rolename);
/*  48 */     os.marshal(this.zoneid);
/*  49 */     os.marshal(this.mapzone);
/*  50 */     os.marshal(this.posx);
/*  51 */     os.marshal(this.posy);
/*  52 */     os.marshal(this.posz);
/*  53 */     os.marshal(this.content);
/*  54 */     return os;
/*     */   }
/*     */ 
/*     */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException {
/*  58 */     this.roleid = os.unmarshal_int();
/*  59 */     this.localsid = os.unmarshal_int();
/*  60 */     os.unmarshal(this.rolename);
/*  61 */     os.unmarshal(this.comp_rolename);
/*  62 */     this.zoneid = os.unmarshal_int();
/*  63 */     os.unmarshal(this.mapzone);
/*  64 */     this.posx = os.unmarshal_float();
/*  65 */     this.posy = os.unmarshal_float();
/*  66 */     this.posz = os.unmarshal_float();
/*  67 */     os.unmarshal(this.content);
/*  68 */     return os;
/*     */   }
/*     */ 
/*     */   public Object clone() {
/*     */     try {
/*  73 */       Complain2GM o = (Complain2GM)super.clone();
/*  74 */       o.rolename = ((Octets)this.rolename.clone());
/*  75 */       o.comp_rolename = ((Octets)this.comp_rolename.clone());
/*  76 */       o.mapzone = ((Octets)this.mapzone.clone());
/*  77 */       o.content = ((Octets)this.content.clone());
/*  78 */       return o;
/*     */     } catch (Exception e) {
/*     */     }
/*  81 */     return null;
/*     */   }
/*     */ 
/*     */   public void Process(Manager manager, Session session) throws ProtocolException
/*     */   {
/*  86 */     Complain com = new Complain();
/*  87 */     com.roleid = this.roleid;
/*  88 */     com.zoneid = this.zoneid;
/*     */     try {
/*  90 */       com.rolename = this.rolename.getString();
/*  91 */       com.mapzone = this.mapzone.getString();
/*  92 */       byte[] tbytes = this.content.getBytes();
/*  93 */       com.com_type = new byte[4];
/*  94 */       com.com_type[0] = tbytes[0];
/*  95 */       com.com_type[1] = tbytes[1];
/*  96 */       com.com_type[2] = tbytes[2];
/*  97 */       com.com_type[3] = tbytes[3];
/*  98 */       com.content = new Octets(tbytes, 4, tbytes.length - 4).getString();
/*  99 */       System.out.println("=====================Complain2GM set content " + com.content + "bs size " + com.com_type.length);
/*     */     }
/*     */     catch (Exception ex) {
/* 102 */       ex.printStackTrace();
/*     */     }
/*     */     try {
/* 105 */       com.com_rolename = this.comp_rolename.getString();
/*     */     } catch (Exception ex) {
/* 107 */       ex.printStackTrace();
/*     */     }
/* 109 */     com.x = this.posx;
/* 110 */     com.y = this.posy;
/* 111 */     com.z = this.posz;
/* 112 */     String flag = Conf.GetInstance().find("public", "savecomplaintodb");
/* 113 */     if (flag.equals("true"))
/*     */     {
/* 115 */       GMService gs = new GMServiceImpl();
/* 116 */       LogInfo info = new LogInfo(-1, "", "投诉存放到数据库中!");
/* 117 */       Complain[] result = gs.fetchComplains(info);
/* 118 */       Complain complain = null;
/* 119 */       MySqlCon my = new MySqlCon();
/* 120 */       if (result != null) {
/* 121 */         String[] sqls = new String[result.length];
/* 122 */         for (int i = 0; i < result.length; i++) {
/* 123 */           complain = result[i];
/* 124 */           String sql = "insert into complains(comtype,roleid,rolename,comroleid,comrolename,zoneid,mapzone,x,y,z,content) values(";
/* 125 */           sql = sql + "'" + complain.com_type + "',";
/* 126 */           sql = sql + complain.roleid + ",";
/* 127 */           sql = sql + "'" + complain.rolename + "',";
/* 128 */           sql = sql + complain.com_roleid + ",";
/* 129 */           sql = sql + "'" + complain.com_rolename + "',";
/* 130 */           sql = sql + complain.zoneid + ",";
/* 131 */           sql = sql + "'" + complain.mapzone + "',";
/* 132 */           sql = sql + complain.x + ",";
/* 133 */           sql = sql + complain.y + ",";
/* 134 */           sql = sql + complain.z + ",";
/* 135 */           sql = sql + "'" + complain.content + "')";
/* 136 */           sqls[i] = sql;
/*     */         }
/*     */ 
/* 139 */         my.updateBatch(sqls);
/* 140 */         my.close();
/*     */       }
/*     */     }
/*     */     else
/*     */     {
/* 145 */       LocalDB.getInstance(1000, 10000, 7200, false).addComplain(com);
/*     */     }
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.Complain2GM
 * JD-Core Version:    0.6.2
 */