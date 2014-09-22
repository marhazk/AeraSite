/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.PollIO;
/*     */ import com.goldhuman.IO.Protocol.Protocol;
/*     */ import com.goldhuman.IO.Protocol.Rpc;
/*     */ 
/*     */ public class UniquenameDB
/*     */ {
/*  28 */   public static final Object locker = new Object();
/*  29 */   public static UniquenameClientManager mgr = new UniquenameClientManager();
/*     */ 
/*     */   public static void init() throws Exception
/*     */   {
/*  33 */     synchronized (mgr)
/*     */     {
/*  35 */       if (null == mgr.s)
/*     */       {
/*  37 */         Protocol.Client(mgr);
/*  38 */         mgr.wait();
/*     */       }
/*     */     }
/*     */   }
/*     */ 
/*     */   public static ID PreCreateRole(int zoneid, int userid, String rolename) throws InterruptedException, Exception
/*     */   {
/*  45 */     init();
/*  46 */     if (null == mgr.s) {
/*  47 */       return new ID(-1, -1);
/*     */     }
/*  49 */     PreCreateRoleArg arg = new PreCreateRoleArg();
/*  50 */     arg.zoneid = zoneid;
/*  51 */     arg.userid = userid;
/*  52 */     arg.rolename.setString(rolename);
/*     */ 
/*  54 */     PreCreateRole rpc = (PreCreateRole)Rpc.Call("PreCreateRole", arg);
/*  55 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(PreCreateRole)");
/*  56 */     PollIO.WakeUp();
/*  57 */     synchronized (rpc) { rpc.wait(); }
/*  58 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(PreCreateRole)");
/*  59 */     if (0 == rpc.retcode)
/*  60 */       return new ID(rpc.roleid, rpc.logicuid);
/*  61 */     return new ID(rpc.retcode > 0 ? -rpc.retcode : rpc.retcode, -1);
/*     */   }
/*     */ 
/*     */   public static boolean PostCreateRole(byte success, int userid, int zoneid, int roleid, String rolename) throws InterruptedException, Exception
/*     */   {
/*  66 */     init();
/*  67 */     if (null == mgr.s) {
/*  68 */       return false;
/*     */     }
/*  70 */     PostCreateRoleArg arg = new PostCreateRoleArg();
/*  71 */     arg.success = success;
/*  72 */     arg.userid = userid;
/*  73 */     arg.zoneid = zoneid;
/*  74 */     arg.roleid = roleid;
/*  75 */     arg.rolename.setString(rolename);
/*     */ 
/*  77 */     PostCreateRole rpc = (PostCreateRole)Rpc.Call("PostCreateRole", arg);
/*  78 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(PostCreateRole)");
/*  79 */     PollIO.WakeUp();
/*  80 */     synchronized (rpc) { rpc.wait(); }
/*  81 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(PostCreateRole)");
/*  82 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static boolean PostDeleteRole(int userid, int zoneid, int roleid, String rolename) throws InterruptedException, Exception
/*     */   {
/*  87 */     init();
/*  88 */     if (null == mgr.s) {
/*  89 */       return false;
/*     */     }
/*  91 */     PostDeleteRoleArg arg = new PostDeleteRoleArg();
/*  92 */     arg.userid = userid;
/*  93 */     arg.zoneid = zoneid;
/*  94 */     arg.roleid = roleid;
/*  95 */     arg.rolename.setString(rolename);
/*     */ 
/*  97 */     PostDeleteRole rpc = (PostDeleteRole)Rpc.Call("PostDeleteRole", arg);
/*  98 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(PostDeleteRole)");
/*  99 */     PollIO.WakeUp();
/* 100 */     synchronized (rpc) { rpc.wait(); }
/* 101 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(PostDeleteRole)");
/* 102 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int RolenameExists(String rolename) throws InterruptedException, Exception
/*     */   {
/* 107 */     init();
/* 108 */     if (null == mgr.s) {
/* 109 */       return -1;
/*     */     }
/* 111 */     RolenameExistsArg arg = new RolenameExistsArg();
/* 112 */     arg.rolename.setString(rolename);
/*     */ 
/* 114 */     RolenameExists rpc = (RolenameExists)Rpc.Call("RolenameExists", arg);
/* 115 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(RolenameExists)");
/* 116 */     PollIO.WakeUp();
/* 117 */     synchronized (rpc) { rpc.wait(); }
/* 118 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(RolenameExists)");
/* 119 */     if (0 == rpc.retcode) return 0;
/* 120 */     if (60 == rpc.retcode) return 1;
/* 121 */     return -1;
/*     */   }
/*     */ 
/*     */   public static int UserRoleCount(int userid) throws InterruptedException, Exception
/*     */   {
/* 126 */     init();
/* 127 */     if (null == mgr.s) {
/* 128 */       return -1;
/*     */     }
/* 130 */     UserRoleCountArg arg = new UserRoleCountArg();
/* 131 */     arg.userid = userid;
/*     */ 
/* 133 */     UserRoleCount rpc = (UserRoleCount)Rpc.Call("UserRoleCount", arg);
/* 134 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(UserRoleCount)");
/* 135 */     PollIO.WakeUp();
/* 136 */     synchronized (rpc) { rpc.wait(); }
/* 137 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(UserRoleCount)");
/* 138 */     if (0 == rpc.retcode)
/* 139 */       return rpc.count;
/* 140 */     return -1;
/*     */   }
/*     */ 
/*     */   public static ID MoveRoleCreate(int fromzoneid, int zoneid, int userid, String rolename) throws InterruptedException, Exception
/*     */   {
/* 145 */     init();
/* 146 */     if (null == mgr.s) {
/* 147 */       return new ID(-1, -1);
/*     */     }
/* 149 */     MoveRoleCreateArg arg = new MoveRoleCreateArg();
/* 150 */     arg.fromzoneid = fromzoneid;
/* 151 */     arg.zoneid = zoneid;
/* 152 */     arg.userid = userid;
/* 153 */     arg.rolename.setString(rolename);
/*     */ 
/* 155 */     MoveRoleCreate rpc = (MoveRoleCreate)Rpc.Call("MoveRoleCreate", arg);
/* 156 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(MoveRoleCreate)");
/* 157 */     PollIO.WakeUp();
/* 158 */     synchronized (rpc) { rpc.wait(); }
/* 159 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(MoveRoleCreate)");
/* 160 */     if (0 == rpc.retcode)
/*     */     {
/* 162 */       int logicuid = rpc.roleid & 0xFFFFFFF0;
/* 163 */       return new ID(rpc.roleid, logicuid);
/*     */     }
/* 165 */     return new ID(rpc.retcode > 0 ? -rpc.retcode : rpc.retcode, -1);
/*     */   }
/*     */ 
/*     */   public static class ID
/*     */   {
/*     */     public int roleid;
/*     */     public int logicuid;
/*     */ 
/*     */     public ID(int _roleid, int _logicuid)
/*     */     {
/*  19 */       this.roleid = _roleid;
/*  20 */       this.logicuid = _logicuid;
/*     */     }
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UniquenameDB
 * JD-Core Version:    0.6.2
 */