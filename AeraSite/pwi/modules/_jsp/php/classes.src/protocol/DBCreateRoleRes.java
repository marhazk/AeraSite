/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBCreateRoleRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */   public int rolelist;
/*    */   public RoleInfo roleinfo;
/*    */   public int real_referrer;
/*    */   public int refretcode;
/*    */ 
/*    */   public DBCreateRoleRes()
/*    */   {
/* 19 */     this.roleinfo = new RoleInfo();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.retcode);
/* 25 */     os.marshal(this.roleid);
/* 26 */     os.marshal(this.rolelist);
/* 27 */     os.marshal(this.roleinfo);
/* 28 */     os.marshal(this.real_referrer);
/* 29 */     os.marshal(this.refretcode);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 35 */     this.retcode = os.unmarshal_int();
/* 36 */     this.roleid = os.unmarshal_int();
/* 37 */     this.rolelist = os.unmarshal_int();
/* 38 */     os.unmarshal(this.roleinfo);
/* 39 */     this.real_referrer = os.unmarshal_int();
/* 40 */     this.refretcode = os.unmarshal_int();
/* 41 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 48 */       DBCreateRoleRes o = (DBCreateRoleRes)super.clone();
/* 49 */       o.roleinfo = ((RoleInfo)this.roleinfo.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBCreateRoleRes
 * JD-Core Version:    0.6.2
 */