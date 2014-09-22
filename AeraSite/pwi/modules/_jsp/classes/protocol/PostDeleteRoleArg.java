/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class PostDeleteRoleArg extends Rpc.Data
/*    */ {
/*    */   public int userid;
/*    */   public int zoneid;
/*    */   public int roleid;
/*    */   public Octets rolename;
/*    */ 
/*    */   public PostDeleteRoleArg()
/*    */   {
/* 17 */     this.rolename = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.userid);
/* 23 */     os.marshal(this.zoneid);
/* 24 */     os.marshal(this.roleid);
/* 25 */     os.marshal(this.rolename);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 31 */     this.userid = os.unmarshal_int();
/* 32 */     this.zoneid = os.unmarshal_int();
/* 33 */     this.roleid = os.unmarshal_int();
/* 34 */     os.unmarshal(this.rolename);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 42 */       PostDeleteRoleArg o = (PostDeleteRoleArg)super.clone();
/* 43 */       o.rolename = ((Octets)this.rolename.clone());
/* 44 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 47 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PostDeleteRoleArg
 * JD-Core Version:    0.6.2
 */