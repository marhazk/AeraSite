/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class QueryUseridArg extends Rpc.Data
/*    */ {
/*    */   public Octets rolename;
/*    */ 
/*    */   public QueryUseridArg()
/*    */   {
/* 14 */     this.rolename = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.rolename);
/* 20 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 25 */     os.unmarshal(this.rolename);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 33 */       QueryUseridArg o = (QueryUseridArg)super.clone();
/* 34 */       o.rolename = ((Octets)this.rolename.clone());
/* 35 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 38 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.QueryUseridArg
 * JD-Core Version:    0.6.2
 */